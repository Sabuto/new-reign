(function() {
  var CountDownTimer;

  CountDownTimer = function(dt, id) {
    var _day, _hour, _minute, _second, end, selector, showRemaining, timer;
    selector = document.getElementById(id);
    end = new Date(dt);
    _second = 1000;
    _minute = _second * 60;
    _hour = _minute * 60;
    _day = _hour * 24;
    showRemaining = function() {
      var days, distance, hours, minutes, now, seconds;
      now = new Date();
      distance = end - now;
      if (distance <= 0) {
        clearInterval(timer);
        selector.innerHTML = "Now!!";
        return;
      }
      days = Math.floor(distance / _day);
      hours = Math.floor((distance % _day) / _hour);
      minutes = Math.floor((distance % _hour) / _minute);
      seconds = Math.floor((distance % _minute) / _second);
      return selector.innerHTML = days + "days" + hours + "hrs" + minutes + "mins" + seconds + "secs";
    };
    return timer = setInterval(showRemaining, 1000);
  };

}).call(this);

//# sourceMappingURL=timer.js.map