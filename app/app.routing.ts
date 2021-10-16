import { Routes, RouterModule } from '@angular/router';

import { CompetitionListComponent } from './competition/competition.list.component';
import { CompetitionViewComponent } from './competition/competition.view.component';
import { PlayerViewComponent } from './player/player.view.component';


const appRoutes: Routes = [
    { path: 'competition', component: CompetitionListComponent },
    { path: 'competition/:id', component: CompetitionViewComponent },
    { path: 'player/:id', component: PlayerViewComponent },

    // otherwise redirect to home
    { path: '**', redirectTo: 'competition' }
];

export const Routing = RouterModule.forRoot(appRoutes);
