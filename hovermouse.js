document.addEventListener("DOMContentLoaded", function() {
    var upperBar = document.querySelector(".upper-bar");
    var helpIcon = upperBar.querySelector(".helpicon");
    var individualGame = document.querySelector(".individual-game");
    var gameInfo = document.querySelector(".game-info");

    // Initially show individual game
    individualGame.classList.add("visible");

    // Initially hide game info
    gameInfo.style.display = "none";

    var isHovering = false; // Track if help icon is being hovered
    var individualTransitionCompleted = true; // Track if individual game transition is completed
    var hoverTimeout; // Timeout variable for hover duration

    // Function to show game info
    function showGameInfo() {
        if (individualTransitionCompleted && isHovering) {
            // Hide individual game with fade-out effect
            individualGame.style.opacity = "0";
            // Delay setting display to allow fade-out effect
            setTimeout(function() {
                individualGame.style.display = "none";
            }, 300); // Wait for transition to complete

            // Show game info with fade-in effect
            gameInfo.style.display = "block";
            setTimeout(function() {
                gameInfo.style.opacity = "1";
            }, 0); // Small delay for smoother transition
        }
    }

    // Event listener for help icon mouse enter
    helpIcon.addEventListener("mouseenter", function() {
        isHovering = true; // Set help icon as being hovered
        hoverTimeout = setTimeout(function() {
            showGameInfo();
        }, 300); // Set hover duration to 0.3 seconds
    });

    // Event listener for help icon mouse leave
    helpIcon.addEventListener("mouseleave", function() {
        isHovering = false; // Set help icon as not being hovered

        // Clear hover timeout
        clearTimeout(hoverTimeout);

        // Hide game info with fade-out effect
        gameInfo.style.opacity = "0";
        // Delay setting display to allow fade-out effect
        setTimeout(function() {
            gameInfo.style.display = "none";
        }, 100); // Wait for transition to complete

        // Show individual game with fade-in effect
        individualGame.style.display = "block";
        setTimeout(function() {
            individualGame.style.opacity = "1";
        }, 10); // Small delay for smoother transition

        individualTransitionCompleted = true; // Set individual transition as completed
    });

    // Event listener for transition end on individual game
    individualGame.addEventListener("transitionend", function() {
        individualTransitionCompleted = true; // Set individual transition as completed
        showGameInfo();
    });

    // Event listener for transition start on individual game
    individualGame.addEventListener("transitionstart", function() {
        individualTransitionCompleted = false; // Set individual transition as ongoing
    });
});
