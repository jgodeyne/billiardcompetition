import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/map';

@Injectable()
export class CompetitionService {

    constructor(private http: Http) { };

    getCompetitions(): Promise<Object[]> {
        return this.http.get("/api/competition_api.php").toPromise()
            .then(response => response.json())
            .catch(this.handleError);
    }

    getCompetition(competitionId: String): Promise<Object> {
        return this.http.get("/api/competition_api.php?id=" + competitionId).toPromise()
            .then(response => response.json())
            .catch(this.handleError);
    }

    private handleError(error: Response | any) {
        // In a real world app, we might use a remote logging infrastructure
        let errMsg: string;
        if (error instanceof Response) {
            const body = error.json() || '';
            const err = body.error || JSON.stringify(body);
            errMsg = `${error.status} - ${error.statusText || ''} ${err}`;
        } else {
            errMsg = error.message ? error.message : error.toString();
        }
        console.error(errMsg);
        return Promise.reject(errMsg);
    }
}
