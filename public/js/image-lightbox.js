
        window.onload = function () {
            halkaBox.run("gallery1");
            halkaBox.run("gallery2", {
                animation: "fade",
                theme: "dark",
                hideButtons: false,
                preload: 0
            });
            halkaBox.run("hb-single");
            halkaBox.run("singleImage1", {
                theme: "dark"
            });
            halkaBox.run("singleImage2", {
                theme: "dark"
            });
        };
