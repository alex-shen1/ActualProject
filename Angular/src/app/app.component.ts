import { Component } from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'FridginCool';

  session : string | undefined;

  mealplan : any;

  week = [
   "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
  ];

  meals : string[] | undefined; // To be filled with user's saved meals from database

  constructor(private http: HttpClient, private route: ActivatedRoute) {
    this.route.queryParams
      .subscribe(params => {
          this.session = params.session;
          console.log(this.session)

          const headers = {'Content-Type': 'application/json; charset=utf-8'};
          const body = {'session': this.session};
          this.http.post('http://localhost/FridginCool/PHP/planner-backend.php',
            body, {responseType: "text"})
            .subscribe(response => {
              // console.log(response);
              const response_json = JSON.parse(response);
              console.log(response_json)
              const mealnames = response_json['mealnames'];
              this.meals = mealnames.replace(/(\r\n|\n|\r)/gm, "").split(",")
              // console.log(this.meals)
              this.mealplan = response_json['plan'];
              console.log(this.mealplan)
            }, error => {
              console.log('ERROR: ', error);
            });
        }
      );
  }
}
