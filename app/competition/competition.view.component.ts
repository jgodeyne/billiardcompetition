import { Component, OnInit} from '@angular/core';
import { ActivatedRoute }   from '@angular/router';
import { CompetitionService } from './competition.service';
import { AuthenticationService } from '../auth/authentication.service';

@Component({
    selector: 'competition-view',
    templateUrl: './competition-view.html'
})

export class CompetitionViewComponent implements OnInit {
    message: String;
    competition;
    total_results;
    authenticated: boolean = false;
    rounds;

    constructor(private route: ActivatedRoute,
                private authenticationService: AuthenticationService, 
                private competitionService: CompetitionService) {
        this.authenticationService.isAuthenticated$.subscribe(auth => {
            this.authenticated = auth;
        });
    }

    getCompetition(id: String): void {
        this.competitionService.getCompetition(id)
            .then(
                competition => this.initCompetition(competition),
                error => this.message = <any>error
                );
    }
    
    ngOnInit(): void {
        let id: string = this.route.snapshot.paramMap.get('id');
        this.getCompetition(id);
    }

    goTo(location: string): void {
        window.location.hash = location;
    }
    
    initCompetition(competition) {
        this.competition = competition;
        this.rounds=new Array();
        var i:number;
        for (i = 0; i < this.competition.rounds;i++) {
            this.rounds[i] = i + 1;
        }
    }
}
