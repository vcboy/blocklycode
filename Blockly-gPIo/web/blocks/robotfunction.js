'use strict';

/** Common HSV hue for all blocks in this category. */


Blockly.Blocks['hello'] = {
  init: function () {
    this.appendDummyInput()
      .appendField("输出")
      .appendField(new Blockly.FieldTextInput("hello word"), "say_content");
    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setColour(230);
    this.setTooltip("");
    this.setHelpUrl("");
  }
};

Blockly.JavaScript['hello'] = function(block) {
  var text_say_content = block.getFieldValue('say_content');
  // TODO: Assemble JavaScript into code variable.
  var code = "console.log('" + text_say_content + "');\n";
  return code;
};