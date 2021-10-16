import { Injectable } from '@angular/core';
import { Subject } from 'rxjs/Subject';
import { Http } from '@angular/http';
//import 'rxjs/add/operator/map'

@Injectable()
export class AuthenticationService {
    private isAuthenticated = new Subject<boolean>();
    isAuthenticated$ = this.isAuthenticated.asObservable();
    
    public token: string;
    testUser = { username: 'test', password: 'test', firstName: 'Test', lastName: 'User' };

    constructor(private http: Http) {
        // set token if saved in local storage
        var currentUser = JSON.parse(localStorage.getItem('currentUser'));
        this.token = currentUser && currentUser.token;
    }

    login(username, password): boolean {
        if (username === this.testUser.username && password === this.testUser.password) {
            this.token = 'fake-jwt-token';

            // store username and jwt token in local storage to keep user logged in between page refreshes
            localStorage.setItem('currentUser', JSON.stringify({ username: username, token: this.token }));

            // return true to indicate successful login
            this.isAuthenticated.next(true);
            return true;
        } else {
            // return false to indicate failed login
            this.isAuthenticated.next(false);
            return false;
        }
    };

    logout(): void {
        // clear token remove user from local storage to log user out
        this.token = null;
        localStorage.removeItem('currentUser');
        this.isAuthenticated.next(false);
    }
}