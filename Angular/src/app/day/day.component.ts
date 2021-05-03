import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'app-day',
  templateUrl: './day.component.html',
  styleUrls: ['./day.component.css']
})
export class DayComponent implements OnInit {

  constructor() { }

  @Input() dayOfWeek : any;

  week = [
    "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
  ]; // Unused, just for reference

  // Sample meals
  meals = [
    "Mac & Cheese",
    "Mashed Potatoes",
    "Grilled Chicken",
    "Garden Salad",
    "Baked Beans",
    "Ice Cream",
    "Mushroom Soup",
    "Pizza"
  ]; // To be replaced by user's saved meals from database

  ngOnInit(): void {
  }

}
