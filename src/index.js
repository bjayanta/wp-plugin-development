wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
    title: "Are You Paying Attention",
    icon: "smiley",
    category: "common",
    attributes: {
        skyColor: {type: "string", source: "text", selector: ".skyColor"},
        grassColor: {type: "string", source: "text", selector: ".grassColor"}
    },
    edit: function(props) {
        function updateSkyColor(event) {
            props.setAttributes({skyColor: event.target.value});
        }

        function updateGrassColor(event) {
            props.setAttributes({grassColor: event.target.value});
        }

        // return wp.element.createElement("div", null, [
        //     wp.element.createElement("h1", null, "This is a h1."),
        //     wp.element.createElement("h4", {style: {color: 'skyblue'}}, "Hello this is a h4."),
        // ]);

        return (
            <div>
                {/* <p>Hello, this is a paragraph.</p>
                <h4>Hi there.</h4> */}

                <input type="text" placeholder="sky color" value={props.attributes.skyColor} onChange={updateSkyColor} />
                <input type="text" placeholder="grass color" value={props.attributes.grassColor} onChange={updateGrassColor} />
            </div>
        );
    },
    save: function(props) {
        // return wp.element.createElement("h1", null, "This is the frontend");

        return (
            // <>
            //     <h3>H3 on the frontend.</h3>
            //     <h5>H5 on the frontend.</h5>
            // </>

            <h3>Today the sky is <span className="skyColor">{ props.attributes.skyColor }</span> and the grass is <span className="grassColor">{ props.attributes.grassColor }</span>.</h3>
        );
    }
});