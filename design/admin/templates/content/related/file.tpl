{* DO NOT EDIT THIS FILE! Use an override template instead. *}

<tr class="{$related_object.sequence|wash}">
    <td class="checkbox"><input type="checkbox" id="related-object-id-{$related_object.id}" name="DeleteRelationIDArray[]" value="{$related_object.id}" /></td>
    <td class="icon"><label for="related-object-id-{$related_object.id}">{$related_object.data_map.file.content.mime_type|mimetype_icon( 'small', concat( 'Class: ', $related_object.class_name, '
', 'Object ID: ', $related_object.id, '
', 'Section: ', $related_object.section_id ) )}</label></td>
    <td class="name"><label for="related-object-id-{$related_object.id}">{$related_object.name|wash}<label></td>
    <td class="filetype">{$related_object.data_map.file.content.mime_type|wash}</td>
    <td class="filesize">{$related_object.data_map.file.content.filesize|si( byte )}</td>
    <td class="code"><input class="linkbox" type="text" value="&lt;object id={$related_object.id} /&gt;" readonly="readonly" /></td>
</tr>
