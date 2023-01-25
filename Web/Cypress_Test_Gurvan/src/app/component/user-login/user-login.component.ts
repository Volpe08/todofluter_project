import { Component } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { Router } from '@angular/router';
import { user } from '../../data/user-list';

@Component({
  selector: 'app-user-login',
  templateUrl: './user-login.component.html',
  styleUrls: ['./user-login.component.css']
})
export class UserLoginComponent {
  constructor (
    private formBuilder: FormBuilder,
    private router: Router
  ) { }

  items = user;

  loginForm = this.formBuilder.group({
    name: '',
    password: ''
  });

  onSubmit(): void {
    let flag = false;
    let login = document.querySelector('#login');
    let logout = document.querySelector('#logout');
    
    for (let i = 0; i < this.items.length; i++) {
      if (this.loginForm.value.name == this.items[i].name && this.loginForm.value.password == this.items[i].password) {
        flag = true;
        localStorage.setItem('flag', flag.toString());

        logout?.classList.remove('hidden');
        login?.classList.add('hidden');

        this.router.navigate(['/']);
      }
    }

    if (!flag) {
      window.alert('Wrong name or password');
    }
  }
}