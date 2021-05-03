import { Component, OnInit, Input } from '@angular/core';


@Component({
  selector: 'app-day',
  templateUrl: './day.component.html',
  styleUrls: ['./day.component.css']
})
export class DayComponent implements OnInit{
  @Input() dayOfWeek: any;
  @Input() meals : any;
  @Input() mealplan : any;


  ngOnInit(): void {
    console.log(this.mealplan);
  }
}
