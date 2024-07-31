<!doctype html>
<html lang="es">
<link rel="stylesheet" href="css/styles.css">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Calendario</title>
    <?php
      include_once 'includes/head.php';
      require_once 'includes/events.php';
    ?>
    <!-- Bootstrap CSS v5.2.1 -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/locales-all.js"></script>

</style>
</head>

<body>
<?php include_once 'includes/header.php'; ?>
<div class="container-fluid">
    <div class="row">
                <h1 class="h2">Calendario</h1>
            </div>
            <div id='calendar'></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const getAllData = () => {
      const obj = {
        action: 'showData'
      }

      fetch('includes/events.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(obj)
        })
        .then(response => response.json())
        .then(json => {
           let eventsArray = []
          json.forEach((row, index) => {
            const event = {
                id: row.id,
                start: row.start_date,
                end: row.end_date,
                title: row.title,
                // backgroundColor: colors[index]
            }
            eventsArray.push(event)
          })
          sessionStorage.setItem('events', JSON.stringify(eventsArray))
        })
    }

    getAllData()
    const allEvents = JSON.parse(sessionStorage.getItem('events'))
    console.log(allEvents) 
    const calendarEl = document.querySelector('#calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        dateClick: function(info) {
            alert('Seleccionaste el dia '+info.dateStr);
            console.log(info)
        },
        events: allEvents

    });
    calendar.render();
});
</script>
</body>
</html>