{* DO NOT EDIT THIS FILE! Use an override template instead. *}
{if and($attribute|get_class|eq('ezinformationcollectionattribute'), $attribute.content.is_valid)}
    {$attribute.content.year}.{$attribute.content.month}.{$attribute.content.day}&nbsp;{$attribute.content.hour}:{$attribute.content.minute}{if $attribute.contentclass_attribute.data_int2|eq(1)}:{$attribute.content.second}{/if}
{/if}
