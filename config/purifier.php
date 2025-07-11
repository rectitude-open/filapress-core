<?php

declare(strict_types=1);
/**
 * Ok, glad you are here
 * first we get a config instance, and set the settings
 * $config = HTMLPurifier_Config::createDefault();
 * $config->set('Core.Encoding', $this->config->get('purifier.encoding'));
 * $config->set('Cache.SerializerPath', $this->config->get('purifier.cachePath'));
 * if ( ! $this->config->get('purifier.finalize')) {
 *     $config->autoFinalize = false;
 * }
 * $config->loadArray($this->getConfig());
 *
 * You must NOT delete the default settings
 * anything in settings should be compacted with params that needed to instance HTMLPurifier_Config.
 *
 * @link http://htmlpurifier.org/live/configdoc/plain.html
 */

return [
    'encoding' => 'UTF-8',
    'finalize' => true,
    'ignoreNonStrings' => false,
    'cachePath' => storage_path('app/purifier'),
    'cacheFileMode' => 0755,
    'settings' => [
        'article' => [
            'HTML.Doctype' => 'HTML5',
            'HTML.DefinitionID' => 'article-html-content',
            'HTML.DefinitionRev' => 1,
            'Core.Encoding' => 'UTF-8',

            'HTML.Allowed' => implode(',', [
                'div[class|style]', 'p[class|style]', 'br', 'hr[class|style]',
                'h1[id|class|style]', 'h2[id|class|style]', 'h3[id|class|style]', 'h4[id|class|style]', 'h5[id|class|style]', 'h6[id|class|style]',
                'section[class|style]', 'nav[class|style]', 'article[class|style]', 'aside[class|style]', 'header[class|style]', 'footer[class|style]', 'main[class|style]',
                'strong', 'em', 'b', 'i', 'u', 's', 'strike', 'sub', 'sup', 'span[class|style]',
                'blockquote[cite|class|style]', 'q[cite|class|style]',
                'code[class|style]', 'pre[class|style]',
                'ul[class|style]', 'ol[start|type|class|style]', 'li[class|style]',
                'a[href|rel|title|class|style]',
                'img[src|alt|title|width|height|class|style]',
                'figure[class|style]', 'figcaption[class|style]',
                'mark[class|style]', 'time[datetime|class|style]',
                'details[open|class|style]', 'summary[class|style]',
                'table[class|style|border|cellspacing|cellpadding|width]',
                'caption[class|style]',
                'thead[class|style]', 'tbody[class|style]', 'tfoot[class|style]',
                'tr[class|style]',
                'td[colspan|rowspan|headers|scope|class|style|align|valign]',
                'th[colspan|rowspan|headers|scope|class|style|align|valign]',
                'iframe[src|width|height|frameborder|allowfullscreen]',
                'video[src|controls|width|height|poster|preload|autoplay|muted|loop|class|style]',
                'source[src|type]',
            ]),

            'CSS.AllowedProperties' => implode(',', [
                'font', 'font-size', 'font-weight', 'font-style', 'font-family',
                'color', 'background-color',
                'text-align', 'text-decoration', 'text-indent', 'line-height',
                'padding', 'padding-left', 'padding-right', 'padding-top', 'padding-bottom',
                'margin', 'margin-left', 'margin-right', 'margin-top', 'margin-bottom',
                'border', 'border-collapse', 'border-spacing', 'border-color', 'border-style', 'border-width',
                'width', 'height', 'max-width',
                'list-style-type',
                'float', 'clear', 'vertical-align',
            ]),

            'Attr.EnableID' => true,
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty' => true,
            'HTML.TargetBlank' => false,
            'HTML.Nofollow' => false,
            'URI.AllowedSchemes' => ['http' => true, 'https' => true, 'mailto' => true, 'tel' => true, 'data' => true, '#' => true],
            'HTML.SafeIframe' => true,
            'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube\.com/embed/|player\.vimeo\.com/video/|www\.bilibili\.com/player\.html\?bvid=)%',
        ],
        'default' => [
            'HTML.Doctype' => 'HTML 4.01 Transitional',
            'HTML.Allowed' => 'div,b,strong,i,em,u,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
            'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty' => true,
        ],
        'test' => [
            'Attr.EnableID' => 'true',
        ],
        'youtube' => [
            'HTML.SafeIframe' => 'true',
            'URI.SafeIframeRegexp' => '%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%',
        ],
        'custom_definition' => [
            'id' => 'html5-definitions',
            'rev' => 1,
            'debug' => false,
            'elements' => [
                // http://developers.whatwg.org/sections.html
                ['section', 'Block', 'Flow', 'Common'],
                ['nav',     'Block', 'Flow', 'Common'],
                ['article', 'Block', 'Flow', 'Common'],
                ['aside',   'Block', 'Flow', 'Common'],
                ['header',  'Block', 'Flow', 'Common'],
                ['footer',  'Block', 'Flow', 'Common'],

                // Content model actually excludes several tags, not modelled here
                ['address', 'Block', 'Flow', 'Common'],
                ['hgroup', 'Block', 'Required: h1 | h2 | h3 | h4 | h5 | h6', 'Common'],

                // http://developers.whatwg.org/grouping-content.html
                ['figure', 'Block', 'Optional: (figcaption, Flow) | (Flow, figcaption) | Flow', 'Common'],
                ['figcaption', 'Inline', 'Flow', 'Common'],

                // http://developers.whatwg.org/the-video-element.html#the-video-element
                ['video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common', [
                    'src' => 'URI',
                    'type' => 'Text',
                    'width' => 'Length',
                    'height' => 'Length',
                    'poster' => 'URI',
                    'preload' => 'Enum#auto,metadata,none',
                    'controls' => 'Bool',
                ]],
                ['source', 'Block', 'Flow', 'Common', [
                    'src' => 'URI',
                    'type' => 'Text',
                ]],

                // http://developers.whatwg.org/text-level-semantics.html
                ['s',    'Inline', 'Inline', 'Common'],
                ['var',  'Inline', 'Inline', 'Common'],
                ['sub',  'Inline', 'Inline', 'Common'],
                ['sup',  'Inline', 'Inline', 'Common'],
                ['mark', 'Inline', 'Inline', 'Common'],
                ['wbr',  'Inline', 'Empty', 'Core'],

                // http://developers.whatwg.org/edits.html
                ['ins', 'Block', 'Flow', 'Common', ['cite' => 'URI', 'datetime' => 'CDATA']],
                ['del', 'Block', 'Flow', 'Common', ['cite' => 'URI', 'datetime' => 'CDATA']],
            ],
            'attributes' => [
                ['iframe', 'allowfullscreen', 'Bool'],
                ['table', 'height', 'Text'],
                ['td', 'border', 'Text'],
                ['th', 'border', 'Text'],
                ['tr', 'width', 'Text'],
                ['tr', 'height', 'Text'],
                ['tr', 'border', 'Text'],
            ],
        ],
        'custom_attributes' => [
            ['a', 'target', 'Enum#_blank,_self,_target,_top'],
        ],
        'custom_elements' => [
            ['u', 'Inline', 'Inline', 'Common'],
        ],
    ],

];
