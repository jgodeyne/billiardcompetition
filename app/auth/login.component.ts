import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { AuthenticationService } from './authentication.service';

@Component({
    templateUrl: './login.component.html'
})

export class LoginComponent implements OnInit {
    model: any = {};
    error = '';

    constructor(
        private router: Router,
        private authenticationService: AuthenticationService) { }

    ngOnInit() {
        // reset login status
        this.authenticationService.logout();
    }

    login() {
        if (this.authenticationService.login(this.model.username, this.model.password)) {
            this.router.navigate(['']);
        } else {
            this.error = 'Username or password is incorrect';
        }
    }  
}
