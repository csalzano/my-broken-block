import { registerBlockType } from '@wordpress/blocks';
import { TextControl } from '@wordpress/components';

registerBlockType( 'myguten/test-block', { //Block names must include only lowercase alphanumeric characters or dashes and start with a letter.
	title: 'My Broken Block', //what the user sees
	icon: 'universal-access-alt', //dashicon
	category: 'layout', //block category
	attributes: {
		blockValue: {
			type: 'string',
			source: 'meta',
			meta: 'block_meta_key', //the meta key where the value gets saved
		},
	},

	example: {
		attributes: {
			blockValue: 'Some value',
		},
	},

	edit( { className, setAttributes, attributes } ) {
		// function updateBlockValue( newValue ) {
		//     setAttributes( { blockValue: newValue } );
		// }

		return (
			<div className={ className }>
				<TextControl
					label="My Broken Block"
					value={ attributes.blockValue }
					//onChange={ (newValue) => updateBlockValue( newValue ) }
					onChange={(newtext) => setAttributes({ blockValue: newtext })}
				/>
			</div>
		);
	},

	// No information saved to the block
	// Data is saved to post meta via attributes
	save() {
		return null;
	},
} );