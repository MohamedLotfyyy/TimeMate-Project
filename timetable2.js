let nav = 0;
let clicked = null;
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

const calendar = document.getElementById('calendar');
const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];


function load() {
  const dt = new Date();

  if (nav !== 0) {
    dt.setMonth(new Date().getMonth() + nav);
  }

  const day = dt.getDate();
  const month = dt.getMonth();
  const year = dt.getFullYear();

  const firstDayOfMonth = new Date(year, month, 1);
  const daysInMonth = new Date(year, month + 1, 0).getDate();
  
  const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
    weekday: 'long',
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
  });
  const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);

  document.getElementById('monthDisplay').innerText = 
    `${dt.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

  calendar.innerHTML = '';

  for(let i = 1; i <= paddingDays + daysInMonth; i++) {
    const daySquare = document.createElement('div');
    daySquare.classList.add('day');

    const dayString = `${month + 1}/${i - paddingDays}/${year}`;
    
      if (i > paddingDays) {
        daySquare.innerText = i - paddingDays;
        const eventForDay = events.find(e => e.date === dayString);
    
        if (i - paddingDays === day && nav === 0) {
          daySquare.id = 'currentDay';
        }
    
        if (eventForDay) {
          const eventDiv = document.createElement('div');
          eventDiv.classList.add('event');
          eventDiv.innerText = eventForDay.title;
          daySquare.appendChild(eventDiv);
        }
      }
      else {
        daySquare.classList.add('padding');
      }
      
      calendar.appendChild(daySquare);    
      // updateDeadlines();
    // Create a click event listener for each daySquare to display date on sidebar


    daySquare.addEventListener('click', function() {
      // Remove previous selected day
      const selectedDay = document.querySelector('.selected');
      if (selectedDay) {
        selectedDay.classList.remove('selected');
      }
        // Add selected class to clicked day
        daySquare.classList.add('selected');
        // Get the year, month, and day of the clicked day
        const clickedYear = year;
        const clickedMonth = month;
        const clickedDay = parseInt(daySquare.innerText);

        // Create a new Date object for the clicked day
        const clickedDateObj = new Date(clickedYear, clickedMonth, clickedDay);

        // Format the date as a string in the desired format
        const clickedDate = clickedDateObj.toLocaleDateString('en-us', { weekday: 'long' });

        // Display the clicked day in a separate element on the page
        const clickedDateDisplay = document.getElementById('c-aside__day');
        clickedDateDisplay.innerText = `${clickedDate} | ${clickedDay} ${dt.toLocaleDateString('en-us', { month: 'long' })}`;
        const eventlist = document.getElementById('events');
        const classlist = document.getElementById('classes');
        const tasklist = document.getElementById('tasks');
        const deadlineDivs = daySquare.querySelectorAll('.deadline');
        const timetableDivs = daySquare.querySelectorAll('.university')
        const todoDivs = daySquare.querySelectorAll('.task')
        if (deadlineDivs.length === 0) {
          eventlist.innerText = 'There are no deadlines for today!';
        }
        else {
          eventlist.innerText = ''
          deadlineDivs.forEach(deadlineDiv => {
            const deadlineInfo = deadlineDiv.innerText;
            const deadlineItem = document.createElement('p');
            deadlineItem.innerText = deadlineInfo;
            eventlist.appendChild(deadlineItem);
          });}
        if (timetableDivs.length === 0) {
          classlist.innerText = 'There are no classes for today!';
        }
        else{
          classlist.innerText = ''
          timetableDivs.forEach(timetableDiv => {
            const lectureinfo = timetableDiv.innerText;
            const lectureEvent = document.createElement('p');
            lectureEvent.innerText = lectureinfo;
            classlist.appendChild(lectureEvent);
          });}
          if (todoDivs.length === 0) {
            tasklist.innerText = 'There are no tasks for today!';
          }
          else{
            tasklist.innerText = ''
            todoDivs.forEach(todoDiv => {
              const taskinfo = todoDiv.innerText;
              const taskEvent = document.createElement('p');
              taskEvent.innerText = taskinfo;
              tasklist.appendChild(taskEvent);
            });}

      });
        // Loop through each object in `dayDeadlines`
        dayDeadlines.forEach((deadline) => {
          // Extract the date from the `Deadline` property of the current object
          const deadlineDate = moment(deadline.Deadline, 'YYYY-MM-DD');
          // Format event date as YYYY-MM-DD
          const taskDate = deadlineDate.format('YYYY/MM/DD');
          const taskDay = moment(taskDate).date();
          // Compare the deadline date with the clicked date
          if (taskDay === i - paddingDays && month + 1 === parseInt(taskDate.split('/')[1])) {
            // Do something with the event information
            console.log("there is a task");
            daySquare.classList.add('has-task');
            const todoDiv = document.createElement('div');
            todoDiv.classList.add('task');
            todoDiv.innerHTML = 'Task: ' + deadline.Task + '\n' + 'Deadline: ' + deadline.Deadline;
            daySquare.append(todoDiv);
          }
        });
      
    fetch('./table.json')
      .then(response => response.json())
      .then(data => {
        data.forEach(event => {
          const eventDate = new Date(event['Due Date']).toLocaleDateString('en-US', {
            day: 'numeric',
            month: 'numeric',
            year: 'numeric'
          });
          const eventDay = parseInt(eventDate.split('/')[1]); // this is to parse only the day and if we change 1 by 0, we will parse only the month
          if (eventDay === i - paddingDays && month + 1 === parseInt(eventDate.split('/')[0])) {
            daySquare.classList.add('has-deadline');
              const deadlineDiv = document.createElement('div');
              deadlineDiv.classList.add('deadline');
              deadlineDiv.innerHTML = 'Course Unit: ' + event['Course Id'] + '\n' + event['Assessment Name'] + '\n' + 'Deadline: ' + event['Due Date'];
              daySquare.append(deadlineDiv);
          }
        });
      })
        .catch(error => console.error(error));

      fetch('./timetable.json')
        .then(response => response.json())
        .then(data => {
          data.forEach(event => {
            // Convert event date to moment object
            const momentDate = moment(event['Start'], 'MM/DD/YYYY');
            // Format event date as YYYY-MM-DD
            const eventDate = momentDate.format('YYYY/MM/DD');

            // Get the day of the event
            const eventDay = moment(eventDate).date();
            // Check if the event falls on the current daySquare
            if (eventDay === i - paddingDays && month + 1 === parseInt(eventDate.split('/')[1])) {
              // Do something with the event information
              console.log("yes");
              daySquare.classList.add('has-lecture');
              const timetableDiv = document.createElement('div');
              timetableDiv.classList.add('university');
              timetableDiv.innerHTML = 'Title: ' + event['Title'] + '\n' + 'Start: ' + event['Start'] + '\n' + 'Location: ' + event['Additional Title'];
              daySquare.append(timetableDiv);
            }
          });
        })
        .catch(error => console.error(error));

      }
    }
      
function initButtons() {
  document.getElementById('nextButton').addEventListener('click', () => {
    nav++;
    load();
  });

  document.getElementById('backButton').addEventListener('click', () => {
    nav--;
    load();
  });
}


initButtons();
load();