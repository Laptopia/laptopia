<?php
/** One page-height illustration, with responsive motif placement, below content. */
defined( 'ABSPATH' ) || exit;
$mode = $args['mode'] ?? 'workbench';
if ( ! in_array( $mode, array( 'prices', 'portfolio', 'repair-case', 'region', 'privacy', 'terms', 'workbench', 'ports' ), true ) ) {
    $mode = 'workbench';
}
if ( 'prices' === $mode ) {
    wp_enqueue_script( 'laptopia-currency-scene', get_stylesheet_directory_uri() . '/assets/js/currency-scene.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/currency-scene.js' ), true );
}
wp_enqueue_script( 'laptopia-page-scene', get_stylesheet_directory_uri() . '/assets/js/page-scene.js', array(), filemtime( get_stylesheet_directory() . '/assets/js/page-scene.js' ), true );
?>
<div class="laptopia-page-art laptopia-page-art--<?php echo esc_attr( $mode ); ?> laptopia-page-art--full" aria-hidden="true">
<?php if ( 'prices' === $mode ) : ?>
  <?php foreach ( array( '₪', '$', '€', '£', '¥', '₹', '₩', '₽', '₺', '₴', '₫', '₱', '฿', '₪' ) as $currency ) : ?>
    <span class="laptopia-currency-particle" dir="ltr"><?php echo esc_html( $currency ); ?></span>
  <?php endforeach; ?>
<?php elseif ( 'ports' === $mode ) : ?>
  <?php foreach ( array( 'first', 'middle', 'last' ) as $position ) : ?>
  <svg class="laptopia-page-motif laptopia-page-motif--<?php echo esc_attr( $position ); ?>" viewBox="0 0 240 230" fill="none" focusable="false">
    <rect x="24" y="22" width="88" height="42" rx="4"/><path d="M33 32h70v21H33zM42 45h5m7 0h5m7 0h5m7 0h5m7 0h5"/>
    <rect x="136" y="25" width="79" height="36" rx="18"/><path d="M149 38h53v10h-53z"/>
    <path d="M29 119h82l-8 37H37zM41 128h58l-4 18H45z"/><circle cx="176" cy="137" r="22"/><circle cx="176" cy="137" r="12"/>
    <g class="laptopia-scene-traces"><path d="M44 64v22l24 24v9M88 64v14h65V61M176 61v54M68 156v36h108v-33M176 159v47h-45"/></g>
    <path class="laptopia-scene-signal" d="M44 64v22l24 24v9"/><path class="laptopia-scene-signal" d="M176 61v54"/><path class="laptopia-scene-signal" d="M68 156v36h108v-33"/>
  </svg>
  <?php endforeach; ?>
<?php elseif ( 'portfolio' === $mode || 'workbench' === $mode ) : ?>
  <svg class="laptopia-page-motif laptopia-page-motif--first laptopia-exploded" viewBox="0 0 260 330" fill="none" focusable="false">
    <g class="laptopia-assembly-lid"><rect x="30" y="18" width="200" height="123" rx="8"/><path d="M42 31h176v97H42z"/><path d="M72 147h116"/></g>
    <g class="laptopia-assembly-board"><path d="M47 174h166v61H47z"/><rect x="75" y="185" width="37" height="31" rx="3"/><path d="M69 191h6m-6 10h6m37-10h6m-6 10h6M145 184h51v13h-51zM145 207h51v13h-51zM153 187v7m8-7v7m8-7v7m8-7v7m8-7v7"/></g>
    <g class="laptopia-assembly-keys"><path d="M30 156h200l20 36H10z"/><path d="M49 162h163M40 170h181M31 179h199M70 183h120"/></g>
    <g class="laptopia-assembly-cover"><path d="M27 264h206l19 38H8z"/><path d="M86 280h87M109 290h41"/></g>
  </svg>
  <svg class="laptopia-page-motif laptopia-page-motif--last laptopia-finished" viewBox="0 0 260 190" fill="none" focusable="false">
    <rect x="30" y="20" width="200" height="124" rx="8"/><path d="M42 32h176v98H42zM25 152h210l18 21H7zM85 161h90M111 167h38"/><path class="laptopia-motif-confirm" d="m110 80 14 14 30-34"/>
  </svg>
<?php elseif ( 'repair-case' === $mode ) : ?>
  <?php foreach ( array( 'first', 'middle', 'last' ) as $motif_index => $position ) : ?>
  <svg class="laptopia-page-motif laptopia-page-motif--<?php echo esc_attr( $position ); ?> laptopia-pcb-motif" viewBox="0 <?php echo $motif_index === 1 ? '340' : '0'; ?> 240 350" fill="none" focusable="false">

        <g class="laptopia-scene-traces"><path d="M-20 40h75l25 25v65h42M240 93h-45v91l-30 30h-73v72H-10M-10 354h80l30-30h78v85l44 44h28M240 540h-68l-24 24v76H60l-30 30H-10"/><path d="M-10 55h54l20 20v70h57M240 108h-30v82l-30 30M-10 369h84l32-30h56v78l45 45h43M240 555h-59l-18 18v81H64"/></g>
        <g><rect x="122" y="113" width="51" height="40" rx="4"/><path d="M130 105v8m12-8v8m12-8v8m12-8v8m-36 40v8m12-8v8m12-8v8m12-8v8M114 123h8m-8 12h8m51-12h8m-8 12h8"/><rect x="62" y="264" width="34" height="17" rx="3"/><path d="M69 258v6m9-6v6m9-6v6m-18 17v6m9-6v6m9-6v6"/><rect x="121" y="393" width="43" height="56" rx="4"/><path d="M126 401h33v40h-33zM111 401h10m-10 12h10m-10 12h10m43-24h10m-10 12h10m-10 12h10"/><rect x="36" y="531" width="48" height="23" rx="3"/><path d="M43 536v13m8-13v13m8-13v13m8-13v13m8-13v13M48 578h21v10H48zM94 596h10v23H94z"/></g>
        <g class="laptopia-scene-testpoints"><circle cx="55" cy="40" r="5"/><circle cx="195" cy="184" r="5"/><circle cx="70" cy="354" r="5"/><circle cx="178" cy="409" r="5"/><circle cx="148" cy="564" r="5"/><circle cx="60" cy="640" r="5"/></g>
        <path class="laptopia-scene-signal" d="M-20 40h75l25 25v65h42"/><path class="laptopia-scene-signal" d="M240 93h-45v91l-30 30h-73v72H-10"/><path class="laptopia-scene-signal" d="M-10 354h80l30-30h78v85l44 44h28"/><path class="laptopia-scene-signal" d="M240 540h-68l-24 24v76H60l-30 30H-10"/>

  </svg>
  <?php endforeach; ?>
<?php elseif ( 'privacy' === $mode ) : ?>
  <svg class="laptopia-page-motif laptopia-page-motif--first" viewBox="0 0 190 220" fill="none" focusable="false">
    <path d="M95 15 159 39v65c0 43-25 76-64 99-39-23-64-56-64-99V39l64-24Z"/>
    <g class="laptopia-secure-lock"><rect x="68" y="97" width="54" height="48" rx="6"/><path d="M79 97V82a16 16 0 0 1 32 0v15"/><circle cx="95" cy="120" r="3"/><path d="M95 123v8"/></g>
    <g class="laptopia-secure-packets"><circle cx="12" cy="69" r="3"/><circle cx="25" cy="81" r="3"/><circle cx="38" cy="93" r="3"/></g>
  </svg>
  <svg class="laptopia-page-motif laptopia-page-motif--middle" viewBox="0 0 190 220" fill="none" focusable="false">
    <path d="M31 16h89l34 34v157H31zM120 16v35h34M51 77h77m-77 19h77m-77 19h57"/>
    <g class="laptopia-secure-lock"><rect x="100" y="152" width="59" height="47" rx="7"/><path d="M110 152v-14a19 19 0 0 1 38 0v14"/><circle cx="129" cy="176" r="3"/></g>
  </svg>
  <svg class="laptopia-page-motif laptopia-page-motif--last" viewBox="0 0 190 200" fill="none" focusable="false">
    <path d="M24 37h108v101H24zM37 54h55m-55 17h55m-55 17h37"/><path d="m132 91 36 13v33c0 21-14 37-36 52-22-15-36-31-36-52v-33z"/><path class="laptopia-motif-confirm" d="m117 135 11 11 22-27"/>
  </svg>
<?php elseif ( 'terms' === $mode ) : ?>
  <?php foreach ( array( 'first', 'middle', 'last' ) as $motif_index => $position ) : ?>
  <svg class="laptopia-page-motif laptopia-page-motif--<?php echo esc_attr( $position ); ?> laptopia-agreement" viewBox="0 0 190 235" fill="none" focusable="false">
    <path d="M29 13h94l36 36v170H29zM123 13v37h36"/>
    <g class="laptopia-agreement-line"><path d="M49 78h86"/></g>
    <g class="laptopia-agreement-line"><path d="M49 99h86"/></g>
    <g class="laptopia-agreement-line"><path d="M49 120h62"/></g>
    <?php if ( 1 === $motif_index ) : ?>
      <g class="laptopia-agreement-seal"><circle cx="129" cy="179" r="27"/><circle cx="129" cy="179" r="21"/><path class="laptopia-motif-confirm" d="m117 178 9 10 20-24"/></g>
    <?php elseif ( 2 === $motif_index ) : ?>
      <path d="M49 163h15v15H49zM76 172h55"/><path class="laptopia-motif-confirm" d="m51 169 5 5 9-13"/>
    <?php else : ?>
      <path d="M49 163h62m-62 16h40"/>
    <?php endif; ?>
  </svg>
  <?php endforeach; ?>
<?php else : ?>
  <svg class="laptopia-page-motif laptopia-page-motif--first" viewBox="0 0 210 250" fill="none" focusable="false">
    <path class="laptopia-art-route" d="M101 120 34 37m67 83 74-73m-74 73 89 81m-89-81-66 96m66-96 4-106"/><circle class="laptopia-art-hub" cx="101" cy="120" r="14"/><circle cx="34" cy="37" r="6"/><circle cx="175" cy="47" r="6"/><circle cx="190" cy="201" r="6"/><circle cx="35" cy="216" r="6"/><circle cx="105" cy="14" r="6"/>
  </svg>
  <svg class="laptopia-page-motif laptopia-page-motif--middle" viewBox="0 0 120 140" fill="none" focusable="false"><path d="M60 126s42-47 42-77a42 42 0 0 0-84 0c0 30 42 77 42 77Z"/><circle cx="60" cy="49" r="15"/></svg>
  <svg class="laptopia-page-motif laptopia-page-motif--last" viewBox="0 0 210 180" fill="none" focusable="false"><path d="M31 140h147V62l-74-40-73 40zM62 140V88h84v52M87 88v52M31 62h147"/><path class="laptopia-art-route" d="M104 164h91"/><circle class="laptopia-art-hub" cx="104" cy="164" r="5"/></svg>
<?php endif; ?>
<?php if ( 'privacy' === $mode || 'terms' === $mode ) : ?>
  <svg class="laptopia-page-motif laptopia-page-motif--ending" viewBox="0 0 170 180" fill="none" focusable="false">
  <?php if ( 'privacy' === $mode ) : ?>
    <g class="laptopia-secure-lock"><rect x="39" y="75" width="92" height="77" rx="12"/><path d="M54 75V51a31 31 0 0 1 62 0v24"/><circle cx="85" cy="109" r="7"/><path d="M85 116v14"/></g>
  <?php else : ?>
    <path d="M25 18h89l29 29v116H25zM114 18v30h29M44 69h75m-75 18h75m-75 18h48"/><path class="laptopia-motif-confirm" d="m62 128 14 14 28-33"/>
  <?php endif; ?>
  </svg>
<?php endif; ?>
</div>
