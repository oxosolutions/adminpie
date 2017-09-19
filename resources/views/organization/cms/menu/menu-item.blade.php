
<ul class="menu ui-sortable" id="menu-to-edit"> 
    @foreach($selectedPage as $k => $v)
        <li id="menu-item-32" class="menu-item menu-item-page pending menu-item-depth-0 menu-item-edit-inactive" style="display: list-item; position: relative; left: 0px; top: 0px;">
            <dl class="menu-item-bar">
                <dt class="menu-item-handle ui-sortable-handle">

                    <span class="item-title" ><span class="menu-item-title">{{ $v->label }}</span> <span class="is-submenu" style="display: none;">sub item</span></span>
                    <span class="item-controls">
                        <span class="item-type">Page</span>
                        <span class="item-type">
                            <a href="javascript:;" class="delete_page" menu_id="{{ $v->menu_id }}" data_id="{{ $v->page_id }}">
                                <i class="fa fa-trash" ></i>
                            </a>
                        </span>
                        <span class="item-order hide-if-js">
                            <a href="" class="item-move-up"><abbr title="Move up">↑</abbr></a>
                            |
                            <a href="" class="item-move-down"><abbr title="Move down">↓</abbr></a>
                        </span>
                    </span>
                </dt>
            </dl>
            
            <div class="menu-item-settings" id="menu-item-settings-32" style="display: none;">
                <p class="description description-thin">
                    <label for="edit-menu-item-title-32">
                        Navigation Label<br>
                        <input type="text" id="edit-menu-item-title-32" class="widefat edit-menu-item-title" name="menu-item-title[32]" value="Sample Page">
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-attr-title-32">
                        Title Attribute<br>
                        <input type="text" id="edit-menu-item-attr-title-32" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[32]" value="">
                    </label>
                </p>
                <p class="field-link-target description hidden-field">
                    <label for="edit-menu-item-target-32">
                        <input type="checkbox" id="edit-menu-item-target-32" value="_blank" name="menu-item-target[32]">
                        Open link in a new window/tab                       </label>
                </p>
                <p class="field-css-classes description description-thin hidden-field">
                    <label for="edit-menu-item-classes-32">
                        CSS Classes (optional)<br>
                        <input type="text" id="edit-menu-item-classes-32" class="widefat code edit-menu-item-classes" name="menu-item-classes[32]" value="">
                    </label>
                </p>
                <p class="field-xfn description description-thin hidden-field">
                    <label for="edit-menu-item-xfn-32">
                        Link Relationship (XFN)<br>
                        <input type="text" id="edit-menu-item-xfn-32" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[32]" value="">
                    </label>
                </p>
                <p class="field-description description description-wide hidden-field">
                    <label for="edit-menu-item-description-32">
                        Description<br>
                        <textarea id="edit-menu-item-description-32" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[32]"></textarea>
                        <span class="description">The description will be displayed in the menu if the current theme supports it.</span>
                    </label>
                </p>

                <p class="description description-wide oxo-menu-style">
                    <label for="menu-item-oxo-menu-style-32>">
                        Menu First Level Style<br>
                        <select id="menu-item-oxo-menu-style-32" class="widefat edit-menu-item-target" name="menu-item-oxo-menu-style[32]">
                            <option value="" selected="selected">Default Style</option>
                            <option value="oxo-button-small">Button Small</option>
                            <option value="oxo-button-medium">Button Medium</option>
                            <option value="oxo-button-large">Button Large</option>
                            <option value="oxo-button-xlarge">Button xLarge</option>
                        </select>
                    </label>
                </p>
                <p class="field-megamenu-icon description description-wide">
                    <label for="edit-menu-item-megamenu-icon-32">
                        Menu Icon (use full font awesome name)          <input type="text" id="edit-menu-item-megamenu-icon-32" class="widefat code edit-menu-item-megamenu-icon" name="menu-item-oxo-megamenu-icon[32]" value="">
                    </label>
                </p>

                <p class="field-move hide-if-no-js description description-wide">
                    <label>
                        <span>Move</span>
                        <a href="#" class="menus-move menus-move-up" data-dir="up" aria-label="Move up one" style="display: none;">Up one</a>
                        <a href="#" class="menus-move menus-move-down" data-dir="down" style="display: inline;" aria-label="Move down one">Down one</a>
                        <a href="#" class="menus-move menus-move-left" data-dir="left" style="display: none;" aria-label="Move out from under Home">Out from under Home</a>
                        <a href="#" class="menus-move menus-move-right" data-dir="right" aria-label="Move under Home" style="display: none;">Under Home</a>
                        <a href="#" class="menus-move menus-move-top" data-dir="top" aria-label="Move to the top" style="display: none;">To the top</a>
                    </label>
                </p>

                <div class="menu-item-actions description-wide submitbox">
                    <p class="link-to-original">
                        Original: <a href="http://aione.oxosolutions.com/sample-page/">Sample Page</a>                          </p>
                        <a class="item-delete submitdelete deletion" id="delete-32" href="http://aione.oxosolutions.com/wp-admin/nav-menus.php?action=delete-menu-item&amp;menu-item=32&amp;_wpnonce=71acb71d61">Remove</a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-32" href="http://aione.oxosolutions.com/wp-admin/nav-menus.php?edit-menu-item=32&amp;cancel=1505365860#menu-item-settings-32">Cancel</a>
                </div>

                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[32]" value="32">
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[32]" value="2">
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[32]" value="page">
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[32]" value="0">
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[32]" value="1">
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[32]" value="post_type">
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport" style=""></ul>
        </li>
    @endforeach
</ul>