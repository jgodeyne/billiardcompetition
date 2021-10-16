import { Component, OnInit} from '@angular/core';
import { PlayerService } from './player.service';
import { AuthenticationService } from '../auth/authentication.service';
import { ActivatedRoute }   from '@angular/router';

@Component({
    selector: 'player-view',
    templateUrl: './player-view.html'
})

export class PlayerViewComponent implements OnInit {
    message: string;
    player;
    results;
    totalresult;
    selectedMatch = null;
    authenticated: boolean = false;
    dialogRef;

    constructor(
        private route: ActivatedRoute,
        private authenticationService: AuthenticationService,
        private playerService: PlayerService
        ){
            this.authenticationService.isAuthenticated$.subscribe(auth => {
            this.authenticated = auth;
        });
    }

    getPlayer(playerId: String): void {
        this.playerService.getPlayer(playerId)
            .then(
            player => this.player = player,
            error => this.message = <any>error
            );
    }

    getResultsForPlayer(playerId: String): void {
        this.playerService.getResultsPlayer(playerId)
            .then(
            list => this.results = list,
            error => this.message = <any>error
            );
    }
    
    getTotalResultForPlayer(playerId: String): void {
        this.playerService.getTotalResultPlayer(playerId)
            .then(
            totalresult => this.totalresult = totalresult,
            error => this.message = <any>error
            );
    }

    ngOnInit(): void {
        let id: string = this.route.snapshot.paramMap.get('id');
        this.getPlayer(id);
        this.getResultsForPlayer(id);
        this.getTotalResultForPlayer(id);
    }
}