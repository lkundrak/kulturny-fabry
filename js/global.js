function venueMap(venue_id, event_id, position_top, position_left) {
    u = "http://kultura/img/maps/";
    d = document.getElementById('venue_map');
    i = document.getElementById('venue_map_img');

    if(d.style.display == "none" || d.style.display == "") {
        i.src = u + venue_id + ".png";
        d.style.display = "block";
        eid = event_id;
        d.style.top = position_top + 20;
        d.style.left = position_left;
    } else if(d.style.display == "block" && eid == event_id) {
        d.style.display = "none";
        eid = 0;
    } else if(d.style.display == "block" && eid != event_id) {
        i.src = u + venue_id + ".png";
        eid = event_id;
        d.style.top = position_top + 20;
        d.style.left = position_left;
    }
}
