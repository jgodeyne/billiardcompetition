import { Component, OnInit, Input} from '@angular/core';
import { AuthenticationService } from '../auth/authentication.service';

@Component({
    selector: 'result-form',
    templateUrl: './result-form.html'
})

export class ResultFormComponent  implements OnInit {
    @Input() match;
    
    player1Result: PlayerResult;
    player2Result: PlayerResult;
    
    message: string;
    authenticated: boolean = false;

    constructor(private authenticationService: AuthenticationService) {
        this.authenticationService.isAuthenticated$.subscribe(auth => {
            this.authenticated = auth;
        });
    }
    
    ngOnInit(): void {
        
    }
}

export class PlayerResult {
    constructor (
        public points: number,
        public innings: number,
        public highestRun: number
        ) {}
}