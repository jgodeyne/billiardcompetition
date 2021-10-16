import { Component, OnInit, Input} from '@angular/core';
import { AuthenticationService } from '../auth/authentication.service';
import { ResultService } from './result.service';

@Component({
    selector: 'result-list',
    templateUrl: './result-list.html'
})

export class ResultListComponent implements OnInit {
    @Input() player;
    message: string;
    authenticated: boolean = false;
    results;
    ranking;

    constructor(private authenticationService: AuthenticationService
        , private resultService: ResultService) {
        this.authenticationService.isAuthenticated$.subscribe(auth => {
            this.authenticated = auth;
        });
    }
    
    ngOnInit(): void {
        this.getResults(this.player.id);
        this.getRanking(this.player.id);
    }
    
    getResults(playerId): void {
        this.resultService.getResultPlayer(playerId)
            .then(results => this.results = results);
    }
    
    getRanking(playerId): void {
        this.resultService.getRankingPlayer(playerId)
            .then(ranking => this.ranking = ranking);
    }
}