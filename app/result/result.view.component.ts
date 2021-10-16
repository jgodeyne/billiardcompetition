import { Component, Input} from '@angular/core';
import { AuthenticationService } from '../auth/authentication.service';

@Component({
    selector: 'result-view',
    templateUrl: './result-view.html'
})

export class ResultViewComponent {
    @Input() match;
    message: string;
    authenticated: boolean = false;

    constructor(private authenticationService: AuthenticationService) {
        this.authenticationService.isAuthenticated$.subscribe(auth => {
            this.authenticated = auth;
        });
    }
}