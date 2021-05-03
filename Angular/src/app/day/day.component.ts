import { Component, OnInit, Input } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'app-day',
  templateUrl: './day.component.html',
  styleUrls: ['./day.component.css']
})
export class DayComponent implements OnInit{
  session : string | undefined;

  constructor(private http: HttpClient, private route: ActivatedRoute) {

  }

  @Input() dayOfWeek: any;

  week = [
    'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
  ]; // Unused, just for reference

  // Sample meals
  meals = [
    'Mac & Cheese',
    'Mashed Potatoes',
    'Grilled Chicken',
    'Garden Salad',
    'Baked Beans',
    'Ice Cream',
    'Mushroom Soup',
    'Pizza'
  ];// To be replaced by user's saved meals from database

  ngOnInit(): void {
    this.route.queryParams
      .subscribe(params => {
          this.session = params.session;
          console.log(this.session)

        const headers = {'Content-Type': 'application/json; charset=utf-8'};
        const body = {'session': this.session};
        this.http.post('http://localhost/FridginCool/PHP/planner-backend.php',
          body, {responseType: "text"})
          .subscribe(response => {
            console.log(response);
            this.meals = response.replace(/(\r\n|\n|\r)/gm, "").split(",")
            console.log(this.meals)
          }, error => {
            console.log('ERROR: ', error);
          });
        }
      );
  }


}
