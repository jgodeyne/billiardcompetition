import { Component, OnInit, Input} from '@angular/core';
import { MatchService } from './match.service';
import { AuthenticationService } from '../auth/authentication.service';

@Component({
    selector: 'match-list',
    templateUrl: './match-list.html'
})

export class MatchListComponent implements OnInit {
    @Input() competition;
    @Input() roundidx;
    @Input() player;
    message: string;
    matches;
    selectedMatch = null;
    authenticated: boolean = false;
    dialogRef;

    constructor(
        private authenticationService: AuthenticationService,
        private matchService: MatchService
        ){
            this.authenticationService.isAuthenticated$.subscribe(auth => {
            this.authenticated = auth;
        });
    }

    getMatchesRound(competitionId, round): void {
        this.matchService.getMatchesPerRound(competitionId, round)
            .then(
            list => this.matches = list,
            error => this.message = <any>error
            );
    }

    getMatches(competitionId): void {
        this.matchService.getMatchesForThisWeek(competitionId)
            .then(
            list => this.matches = list,
            error => this.message = <any>error
            );
    }
    
    getMatchesPlayer(playerId): void {
        this.matchService.getMatchesPlayer(playerId)
            .then(
            list => this.matches = list,
            error => this.message = <any>error
            );
    }

    showResult(roundidx, match) {
        console.log("showResult: " + match.id)
        this.selectedMatch = match;
        $('#myModal'+roundidx).modal();
    }
    
    ngOnInit(): void {
        if (null != this.roundidx && null != this.competition ) {
            if (this.roundidx == 0) {
                this.getMatches(this.competition.id);
            } else {
                this.getMatchesRound(this.competition.id, this.roundidx);
            }
        } else if (null != this.player) {
            this.getMatchesPlayer(this.player.id);
        }
    }
}