{* DO NOT EDIT THIS FILE! Use an override template instead. *}

{section show=$related_contentobjects|count|gt( 0 )}

    <h3>{'Related objects'|i18n( 'design/standard/content/edit' )}</h3>

    {section show=$grouped_related_contentobjects.images|count|gt( 0 )}

    <table class="list-thumbnails" cellspacing="0">
    <tr>
        {section var=related_object loop=$grouped_related_contentobjects.images}
        <td>
        {related_view_gui view=thumbnail related_object=$related_object}
        </td>
        {delimiter modulo=4}
        </tr><tr>
        {/delimiter}
        {/section}

    </tr>
    </table>

    {/section}

    {section show=$grouped_related_contentobjects.files|count|gt( 0 )}
        <div class="file-detail-list">

            <table class="list" cellspacing="0">
            <tr>
                <th class="checkbox"></th>
                <th class="name" colspan="2">{'Attached files'|i18n( 'design/standard/content/edit' )}:</th>
                <th class="class">{'Type'|i18n( 'design/standard/content/edit' )}:</th>
                <th class="filesize">{'Size'|i18n( 'design/standard/content/edit' )}:</th>
                <th class="code">{'XML code'|i18n( 'design/standard/content/edit' )}:</th>
            </tr>

            {section var=related_object loop=$grouped_related_contentobjects.files sequence=array( bglight, bgdark )}
                {related_view_gui view=file related_object=$related_object}
            {/section}

            </table>
        </div>
    {/section}

    {section show=$grouped_related_contentobjects.objects|count|gt( 0 )}
        <div class="related-detail-list">

            <table class="list" cellspacing="0">
            <tr>
                <th class="checkbox"></th>
                <th class="name" colspan="2">{'Related content'|i18n( 'design/standard/content/edit' )}:</th>
                <th class="class">{'Type'|i18n( 'design/standard/content/edit' )}:</th>
                <th class="code">{'XML code'|i18n( 'design/standard/content/edit' )}:</th>
            </tr>

            {section var=related_object loop=$grouped_related_contentobjects.objects sequence=array( bglight, bgdark )}
                {related_view_gui view=object related_object=$related_object}
            {/section}

            </table>
        </div>
    {/section}

{/section}

<div class="controlbar">
    <div class="editblock">
        <input class="button" type="submit" name="DeleteRelationButton" value="{'Remove selected'|i18n('design/standard/content/edit')}" title="{'Click here to remove the selected items from the list(s) above. The items will only be removed from the list, but not from the system.'|i18n( 'design/admin/layout' )}" />
        <input class="button" type="Submit" name="BrowseObjectButton" value="{'Add existing'|i18n('design/standard/content/edit')}" title="{'Click here to add an existing item as a related object.'|i18n( 'design/admin/layout' )}" />
    </div>

    <div class="createblock">
        <label>{'Location'|i18n( 'design/standard/content/edit' )}</label>
        <select	name="UploadRelationLocationChoice" class="combobox locationchoice">
            <option value="auto">{'Automatic'|i18n( 'design/standard/content/edit' )}</option>
        {let root_node_value=ezini( 'LocationSettings', 'RootNode', 'upload.ini' )
             root_node=cond( $root_node_value|is_numeric, fetch( content, node, hash( node_id, $root_node_value ) ),
                             fetch( content, node, hash( node_path, $root_node_value ) ) )}
        {section var=node loop=fetch( content, tree,
                                      hash( parent_node_id, $root_node.node_id,
                                            class_filter_type, include,
                                            class_filter_array, ezini( 'LocationSettings', 'ClassList', 'upload.ini' ),
                                            depth, ezini( 'LocationSettings', 'MaxDepth', 'upload.ini' ),
                                            limit, ezini( 'LocationSettings', 'MaxItems', 'upload.ini' ) ) )}
            <option value="{$node.node_id}">{'&nbsp;'|repeat( sub( $node.depth, $root_node.depth, 1 ) )}{$node.name|wash}</option>
        {/section}
        {/let}
      	</select>

        <input type="hidden" name="MAX_FILE_SIZE" value="50000000" />
        <input name="UploadRelationFile" type="file" />
        &nbsp;
        <input class="button" type="submit" name="UploadFileRelationButton" value="{'Add new'|i18n('design/standard/content/edit')}" title="{'Click here to upload a file. The file will be placed within the location that is specified using the dropdown menu to the left. In addition, the file will be automatically related to the item that is currently being edited.'|i18n( 'design/admin/layout' )}" />
    </div>

    </div>
</div>


