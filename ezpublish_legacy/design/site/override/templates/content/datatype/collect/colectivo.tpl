{def $user=fetch( 'user', 'current_user'))}
{default attribute_base='ContentObjectAttribute' html_class='full'}
{let data_text=cond( is_set( $#collection_attributes[$attribute.id] ), $#collection_attributes[$attribute.id].data_text, $attribute.content )}
<input class="{eq( $html_class, 'half' )|choose( 'box', 'halfbox' )}" type="hidden" size="70" name="{$attribute_base}_ezstring_data_text_{$attribute.id}" value="{cond( $user.contentobject.main_node.depth|eq(4), $user.contentobject.main_node.parent.object.name, '')}" id="colectivo" />
{/let}
{/default}