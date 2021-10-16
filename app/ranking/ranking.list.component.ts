import { Component, OnInit, Input} from '@angular/core';
import { RankingService } from './ranking.service';
import { AuthenticationService } from '../auth/authentication.service';

@Component({
    selector: 'ranking-list',
    templateUrl: './ranking-list.html'
})

export class RankingListComponent implements OnInit {
    @Input() competition;
    message: String;
    total_results;
    rank: Number = 0;
    authenticated: boolean = false;

    constructor(private authenticationService: AuthenticationService, 
                private rankingService: RankingService) {
        this.authenticationService.isAuthenticated$.subscribe(auth => {
            this.authenticated = auth;
        });
    }

    getRankingList(id: String): void {
        this.rankingService.getRankingList(id)
            .then(
                list => this.total_results = list,
                error => this.message = <any>error
                );
    }

    ngOnInit(): void {
        this.getRankingList(this.competition.id);
    }
}
