import { Component, OnInit, Input } from '@angular/core';
import {HttpClient} from "@angular/common/http";


@Component({
  selector: 'app-day',
  templateUrl: './day.component.html',
  styleUrls: ['./day.component.css']
})
export class DayComponent implements OnInit{
  @Input() dayOfWeek: any;
  @Input() meals : any;
  @Input() mealplan : any;
  @Input() sessionID : any;

  constructor(private http: HttpClient) {
  }

  ngOnInit(): void {
    console.log(this.mealplan);
  }

  updatePlanner(day: string, mealTime: string, mealName: string) {
    // prepare a POST request to PHP backend to save updated plan
    const headers = {'Content-Type': 'application/json; charset=utf-8'};
    const body = {
        'session': this.sessionID,
        'day': day,
        'mealTime': mealTime,
        'mealName': mealName,
      };
    this.http.post('http://localhost/FridginCool/PHP/update-plan.php',
      body, {responseType: "text"})
      .subscribe(response => {
        const response_json = JSON.parse(response);
        console.log(response_json)
      }, error => {
        console.log('ERROR: ', error);
      });
  }
}
