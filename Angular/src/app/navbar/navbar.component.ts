import {Component, OnInit} from '@angular/core';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

  session: string | undefined;

  constructor(private route: ActivatedRoute) {
    this.route.queryParams
      .subscribe(params => {
          this.session = params.session;
          console.log(this.session)
        }
      );
  }

  ngOnInit(): void {
  }

}
