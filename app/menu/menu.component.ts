import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../auth/authentication.service';
import { Router } from '@angular/router';

@Component({
    selector: 'main-menu',
    templateUrl: './menu.html'
})

export class MenuComponent implements OnInit{
    authenticated: boolean = false;
    
    constructor(private authenticationService: AuthenticationService, private router: Router) {
        this.authenticationService.isAuthenticated$.subscribe(auth => {
            this.authenticated = auth;
            console.info("menu component - authenticated: " + this.authenticated);
        });
     }
    
    logout() : void {
        this.authenticationService.logout();
    }
    
    login(): void {
        this.authenticationService.login("test","test");       
    }
    
    ngOnInit() : void {
        
    }
}
