<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php if ( ! empty ( $src ) ) : ?><?php if ( ! empty ( $caption ) ) : ?>
<figure <?php if ( ! empty ( $ID ) ) : ?>id="attachment_<?= $ID; ?>"<?php endif; ?> <?php if ( ! empty ( $width ) or ! empty ( $height ) ) : ?>style="<?php if ( ! empty ( $width ) ) : ?>width: <?= $width; ?>px;<?php endif; ?><?php if ( ! empty ( $height ) ) : ?> height: <?= $height; ?>px;<?php endif; ?>"<?php endif; ?> class="wp-caption<?php if ( ! empty ( $align ) ) : ?> align<?= $align; ?><?php endif; ?>">
<?php if ( ! empty ( $url ) ) : ?><a href="<?= $url; ?>"><?php endif; ?>
<img src="<?= ! empty ( $ver ) ? add_query_arg( 'ver', $ver, $src ) : $src; ?>"<?php if ( ! empty ( $width ) ) : ?> width="<?= $width; ?>px"<?php endif; ?><?php if ( ! empty ( $height ) ) : ?> height="<?= $height; ?>px"<?php endif; ?><?php if ( ! empty ( $srcset ) ) : ?> srcset="<?= $srcset; ?>"<?php endif; ?><?php if ( ! empty ( $sizes ) ) : ?> sizes="<?= $sizes; ?>"<?php endif; ?><?php if ( ! empty ( $alt ) ) : ?> alt="<?= $alt; ?>"<?php endif; ?><?php if ( ! empty ( $id ) ) : ?> id="<?= $id; ?>" <?php endif; ?><?php if ( ! empty ( $ID ) or ! empty ( $size ) or ! empty( $class ) ) : ?> class="<?php if ( ! empty ( $class ) ) : ?><?= $class; ?> <?php endif; ?><?php if ( ! empty ( $size ) ) : ?>size-<?= $size; ?> <?php endif; ?><?php if ( ! empty ( $ID ) ) : ?>wp-image-<?= $ID; ?><?php endif; ?>"<?php endif; ?><?php if ( ! empty ( $title ) ) : ?> title="<?= $title; ?>"<?php endif; ?><?php if ( ! empty ( $extras ) ) : foreach( $extras as $key => $value ) : ?> <?= $key; ?>="<?= $value; ?>"<?php endforeach; endif; ?> />
<?php if ( ! empty ( $url ) ) : ?></a><?php endif; ?>
<figcaption class="wp-caption-text">
<?= $caption; ?>
</figcaption>
</figure>
<?php else : ?>
<?php if ( ! empty ( $url ) ) : ?><a href="<?= $url; ?>"><?php endif; ?>
<img src="<?= ! empty ( $ver ) ? add_query_arg( 'ver', $ver, $src ) : $src; ?>"<?php if ( ! empty ( $width ) ) : ?> width="<?= $width; ?>px"<?php endif; ?><?php if ( ! empty ( $height ) ) : ?> height="<?= $height; ?>px"<?php endif; ?><?php if ( ! empty ( $srcset ) ) : ?> srcset="<?= $srcset; ?>"<?php endif; ?><?php if ( ! empty ( $sizes ) ) : ?> sizes="<?= $sizes; ?>"<?php endif; ?><?php if ( ! empty ( $alt ) ) : ?> alt="<?= $alt; ?>"<?php endif; ?><?php if ( ! empty ( $id ) ) : ?> id="<?= $id; ?>" <?php endif; ?><?php if ( ! empty ( $ID ) or ! empty( $align ) or ! empty( $size ) or ! empty( $class ) ) : ?> class="<?php if ( ! empty ( $class ) ) : ?><?= $class; ?> <?php endif; ?><?php if ( ! empty ( $ID ) ) : ?>wp-image-<?= $ID; ?> <?php endif; ?><?php if ( ! empty ( $align ) ) : ?>align<?= $align; ?> <?php endif; ?><?php if ( ! empty ( $size ) ) : ?>size-<?= $size; ?><?php endif; ?>"<?php endif; ?><?php if ( ! empty ( $title ) ) : ?> title="<?= $title; ?>"<?php endif; ?><?php if ( ! empty ( $extras ) ) : foreach( $extras as $key => $value ) : ?> <?= $key; ?>="<?= $value; ?>"<?php endforeach; endif; ?> />
<?php if ( ! empty ( $url ) ) : ?></a><?php endif; ?>
<?php endif; ?><?php endif; ?>