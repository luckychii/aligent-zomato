# Aligent Code Challenge

To complete the challenge I've used the following
- Bootstrap 4.3
- noUiSlider
- Javascript/JQuery
- PHP



Some observations on how it could be improved
- Use SASS so that I could set colours by variable and use other SASS techniques to improve the CSS rather than everything be hardcoded. If it was a bigger project I'd look at what elements have similar styles so that reusable components could be created as a step 1.
- Have someone from backend confirm the correct variables are being used to set "No Bookings" and "No Delivery" as most restaurants seem to return 0 on the options I've used.
- Ask if there is a better way to retrieve opening hours and compare if the current time falls within the current day hours. I tried looking for some consistency in the data input to use when formatting the opening hours result but didn't find one i was happy with so I have just displayed the full thing.
- Link up the rating and cost sliders. They trigger the update function but don't currently add to the filter. The API had options for cuisine and category but I didn't see an option for rating and cost.
- Ask the designer if they have preferences for mobile views. The results could be displayed differently to improve usability. Perhaps a select dropdown. While my solution could be considered responsive there are improvements that could be made.
- I would like to separate the PHP calls and the HTML so that the code is more templated, but it didn't really make sense to do so here with such short code blocks.
- I've only tested in browser (Chrome/Firefox/IE11) as I'm hosting it locally. Ideally testing on phone/tablet should be performed. I also haven't developed or tested for accessibility performance.