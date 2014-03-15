//<![CDATA[
var selectedTab = 0;

function tabclick(n) {
    if (n === selectedTab)
        return; // nothing to do.
    curvyCorners.setWinResize(false); // for IE, block spurious window resize events 
    var li = document.getElementById('tab' + selectedTab);
    curvyCorners.adjust(li, 'className', ''); // Remove the 'select' style
    li = document.getElementById('page' + selectedTab);
    li.style.display = 'none';                // hide the currently selected sub-page
    li = document.getElementById('page' + n);
    li.style.display = 'block';               // show the new sub-page
    li = document.getElementById('tab' + n);  // get the new (clicked) tab
    curvyCorners.adjust(li, 'className', 'select'); // and update its style
    curvyCorners.redraw();        // Redraw all elements with className curvyRedraw
    selectedTab = n;              // store for future reference
    curvyCorners.setWinResize(true); // OK, allow genuine resize events now
}

curvyCorners.addEvent(window, 'resize', new Function('curvyCorners.handleWinResize();'));
//]]>