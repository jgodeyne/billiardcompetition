import { Component, OnInit } from '@angular/core';
import { CompetitionService } from './competition.service';
import { AuthenticationService } from '../auth/authentication.service';

@Component({
    selector: 'competition-list',
    templateUrl: './competition-list.html'
})

export class CompetitionListComponent implements OnInit {
    competitions;
    authenticated: boolean = false;

    constructor(private authenticationService: AuthenticationService, private competitionService: CompetitionService) {
        this.authenticationService.isAuthenticated$.subscribe(auth => {
            this.authenticated = auth;
        });
    }

    getCompetitions(): void {
        this.competitionService.getCompetitions().then(competitions => this.competitions = competitions);
    }

    ngOnInit(): void {
        this.getCompetitions();
    }
}
