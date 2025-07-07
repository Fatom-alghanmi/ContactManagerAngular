import { Component } from '@angular/core';
import { RouterModule } from '@angular/router'; // Needed for routerLink to work

@Component({
  selector: 'app-about',
  standalone: true, // You must declare this if you're not using NgModule
  imports: [RouterModule], // This enables routerLink in the template
  templateUrl: './about.html',
  styleUrls: ['./about.css'] // Fix: should be style**Urls**, not styleUrl
})
export class About {}
