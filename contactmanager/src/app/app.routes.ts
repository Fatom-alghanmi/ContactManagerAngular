import { Routes } from '@angular/router';
import { Contacts } from './contacts/contacts';
import { About } from './about/about';

export const routes: Routes = [
    { path: "contacts", component: Contacts},
    { path: "about", component: About},
    { path: "**", redirectTo: "/contacts"},
];
