import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import 'rxjs/add/operator/toPromise';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/map';

@Injectable()
export class PlayerService {

    constructor(private http: Http) { };

    getPlayer(playerId: String): Promise<Object[]> {
        return this.http.get("/api/player_api.php?id=" + playerId).toPromise()
            .then(response => response.json())
            .catch(this.handleError);
    }

    getResultsPlayer(playerId: String): Promise<Object[]> {
        return this.http.get("/api/result_api.php?player_id=" + playerId).toPromise()
            .then(response => response.json())
            .catch(this.handleError);
    }

    getTotalResultPlayer(playerId: String): Promise<Object[]> {
        return this.http.get("/api/total_result_api.php?player_id=" + playerId).toPromise()
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
