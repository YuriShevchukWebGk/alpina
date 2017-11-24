function updater(d, h, m, s) {
	var baseTime = new Date();
	baseTime.setTime(baseTime.getTime() + 1000*60*60*24);
	
	// Тут дата устанавливается
	var baseTime = new Date(2017, 10, 26, 23, 59, 59);

	// Период сброса — 3 дня
	var period = 3*24*60*60*1000;

	function update() {
		var cur = new Date();
		// сколько осталось миллисекунд
		//var diff = period - (cur - baseTime) % period;
		var diff = baseTime - cur;
		// сколько миллисекунд до конца секунды
		var millis = diff % 1000;
		diff = Math.floor(diff/1000);
		// сколько секунд до конца минуты
		var sec = diff % 60;
		if(sec < 10) sec = "0"+sec;
		diff = Math.floor(diff/60);
		// сколько минут до конца часа
		var min = diff % 60;
		if(min < 10) min = "0"+min;
		diff = Math.floor(diff/60);
		// сколько часов до конца дня
		var hours = diff % 24;
		if(hours < 10) hours = "0"+hours;
		var days = Math.floor(diff / 24);

		d.innerHTML = days;
		h.innerHTML = hours;
		m.innerHTML = min;
		s.innerHTML = sec;

		// следующий раз вызываем себя, когда закончится текущая секунда
		setTimeout(update, millis);
	}
 
	setTimeout(update, 0);
}

updater(document.getElementById("days"),
document.getElementById("hours"), document.getElementById("minutes"),
document.getElementById("seconds"));