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
          // use subscribe to access parameters in the URL, which session ID is the only one
          this.session = params.session;
          console.log(this.session)

          // prepare a POST request to PHP backend getting meal plan for the current session's user
          const headers = {'Content-Type': 'application/json; charset=utf-8'};
          const body = {'session': this.session};
          this.http.post('http://localhost/FridginCool/PHP/planner-backend.php',
            body, {responseType: "text"})
            .subscribe(response => {
              // returns JSON of mealnames as a comma-separated string and a data structure
              // holding the schedules for each day e.g. "Monday" corresponds to a dictionary
              // mapping "Breakfast", "Lunch", etc. to string names of the meal for that time
              // will be "None" if database didn't have an entry for that day/time

              // formatting done in the PHP, we just need to use it
              const response_json = JSON.parse(response);
              console.log(response_json)
              const mealnames = response_json['mealnames'];
              // comma-separated string with meal names
              this.meals = mealnames.replace(/(\r\n|\n|\r)/gm, "").split(",")
              console.log(this.meals)

              // meal plan data structure
              this.mealplan = response_json['plan'];
              console.log(this.mealplan)
            }, error => {
              console.log('ERROR: ', error);
            });
        }
      );
  }
}
