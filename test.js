// alert("Hello World!");

wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
    title: "Are You Paying Attention",
    icon: "smiley",
    category: "common",
    edit: function() {
        return wp.element.createElement("div", null, [
            wp.element.createElement("h1", null, "This is a h1."),
            wp.element.createElement("h4", {style: {color: 'skyblue'}}, "Hello this is a h4."),
        ]);
    },
    save: function() {
        return wp.element.createElement("h1", null, "This is the frontend");
    }
});