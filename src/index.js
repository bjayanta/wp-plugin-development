import "./index.scss";
import { TextControl, Flex, FlexBlock, FlexItem, Button, Icon, PanelBody, PanelRow, ColorPicker } from "@wordpress/components";
import { InspectorControls, BlockControls, AlignmentToolbar } from "@wordpress/block-editor";
import { ChromePicker } from "react-color";

// imediatly invocked expression function
(function() {
    let locked = false;

    wp.data.subscribe(function() {
        // console.log("Hello");
        const results = wp.data.select("core/block-editor").getBlocks().filter(function(block) {
            return block.name == "ourplugin/are-you-paying-attention" && block.attributes.correctAnswer == undefined;
        });

        if(results.length && locked == false) {
            locked = true;
            wp.data.dispatch("core/editor").lockPostSaving("noanswer");
        }

        if(!results.length && locked) {
            locked = false;
            wp.data.dispatch("core/editor").unlockPostSaving("noanswer");
        }
    });
})();

wp.blocks.registerBlockType("ourplugin/are-you-paying-attention", {
    title: "Are You Paying Attention",
    icon: "smiley",
    category: "common",
    attributes: {
        question: {type: "string"},
        answers: {type: "array", default: [""]},
        correctAnswer: {type: "number", default: undefined},
        bgColor: {type: "string", default: "#ebebeb"},
        theAlignment: {type: "string", default: "left"}
    },
    description: "Give your audience a chance to prove their comprehension.",
    example: {
        attributes: {
            question: "What is my name?",
            correctAnswer: 3,
            answers: ["Jayanta", "Robin", "Sagor", "Baky"],
            theAlignment: "center",
            bgColor: "#d3d3d3"
        }
    },
    edit: EditComponent,
    save: function(props) {
        return null;
    }
});

// Component
function EditComponent(props) {
    function updateQuestion(value) {
        props.setAttributes({question: value});
    }

    function deleteAnswer(indexToDelete) {
        const newAnswers = props.attributes.answers.filter(function(x, index) {
            return index != indexToDelete;
        });

        props.setAttributes({answers: newAnswers});

        if(indexToDelete == props.attributes.correctAnswer) {
            props.setAttributes({
                correctAnswer: undefined
            });
        }
    }

    function markAsCorrect(index) {
        props.setAttributes({correctAnswer: index});
    }

    return (
        <div className="paying-attention-edit-block" style={{ backgroundColor: props.attributes.bgColor }}>
            <BlockControls>
                <AlignmentToolbar value={props.attributes.theAlignment} onChange={x => props.setAttributes({theAlignment: x})} />
            </BlockControls>

            <InspectorControls>
                <PanelBody title="Background Color" initialOpen={true}>
                    <PanelRow>
                        {/* <ColorPicker color={props.attributes.bgColor} onChangeComplete={x => props.setAttributes({bgColor: x.hex})} /> */}
                        <ChromePicker color={props.attributes.bgColor} onChangeComplete={x => props.setAttributes({bgColor: x.hex})} disableAlpha={true} />
                    </PanelRow>
                </PanelBody>
            </InspectorControls>

            <TextControl label="Question:" value={props.attributes.question} onChange={updateQuestion} style={{fontSize: "20px"}} />

            <p style={{ fontSize: "13px", margin: "20px 0 8px 0" }}>Answers:</p>

            {props.attributes.answers.map(function(answer, index) {
                return (
                    <Flex>
                        <FlexBlock>
                            <TextControl value={answer} onChange={newValue => {
                                const newAnswers = props.attributes.answers.concat([]);
                                newAnswers[index] = newValue;
                                props.setAttributes({answers: newAnswers})
                            }} />
                        </FlexBlock>

                        <FlexItem>
                            <Button onClick={() => markAsCorrect(index)}>
                                <Icon className="mark-as-correct" icon={props.attributes.correctAnswer == index ? "star-filled" : "star-empty"} />
                            </Button>
                        </FlexItem>

                        <FlexItem>
                            <Button variant="link" className="attention-delete" onClick={() => deleteAnswer(index)}>Delete</Button>
                        </FlexItem>
                    </Flex>
                )
            })}
            

            <Button variant="primary" onClick={() => {
                props.setAttributes({answers: props.attributes.answers.concat([""])});
            }}>Add another answer</Button>
        </div>
    );
}