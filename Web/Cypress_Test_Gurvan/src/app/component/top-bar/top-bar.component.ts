import { Component } from '@angular/core';
import { Router } from '@angular/router';


@Component({
  selector: 'app-top-bar',
  templateUrl: './top-bar.component.html',
  styleUrls: ['./top-bar.component.css']
})

export class TopBarComponent {
  constructor (
    private router: Router
  ) { }

  flag = localStorage.getItem('flag');

  onLogout(): void {
    let login = document.querySelector('#login');
    let logout = document.querySelector('#logout');

    login?.classList.remove('hidden');
    logout?.classList.add('hidden');

    this.router.navigate(['/']);
    localStorage.removeItem('flag');
    window.alert('Disconnect');
  }
}
