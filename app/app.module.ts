import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpModule } from '@angular/http';
import { FormsModule } from '@angular/forms';
import { MenuComponent } from './menu/menu.component';
import { LoginComponent } from './auth/login.component';
import { Routing }        from './app.routing';
import { AppComponent }  from './app.component';
import { AuthenticationService } from './auth/authentication.service';
import { CompetitionListComponent } from './competition/competition.list.component';
import { CompetitionViewComponent } from './competition/competition.view.component';
import { CompetitionService } from './competition/competition.service';
import { RankingListComponent } from './ranking/ranking.list.component';
import { RankingService } from './ranking/ranking.service';
import { MatchListComponent } from './match/match.list.component';
import { MatchService } from './match/match.service';
import { ResultService } from './result/result.service';
import { ResultViewComponent } from './result/result.view.component';
import { ResultListComponent } from './result/result.list.component';
import { PlayerViewComponent } from './player/player.view.component';
import { PlayerService } from './player/player.service';

@NgModule({
    imports: [
        BrowserModule
        , HttpModule
        , FormsModule
        , Routing
        ],
    declarations: [
        AppComponent
        , MenuComponent
        , LoginComponent
        , CompetitionListComponent
        , CompetitionViewComponent
        , RankingListComponent
        , MatchListComponent
        , ResultViewComponent
        , ResultListComponent
        , PlayerViewComponent
    ],
    providers: [
        CompetitionService
        , AuthenticationService
        , RankingService
        , MatchService
        , ResultService
        , PlayerService
    ],
    bootstrap: [AppComponent]
})
export class AppModule { }
