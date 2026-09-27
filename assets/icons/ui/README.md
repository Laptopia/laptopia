# Laptopia WordPress icon policy

New generic UI icons use the local [Lucide](https://github.com/lucide-icons/lucide) SVG family. The three files here were fetched from the official repository on 2026-09-27. Preserve `LICENSE-LUCIDE.txt` (ISC). `laptopia_ui_icon()` in `inc/ui-icons.php` accepts only explicit local keys, emits decorative SVG with `aria-hidden`, and never calls a runtime CDN.

The existing `inc/icons.php` service/favicons and approved `template-parts/cta-icon.php` brand icons remain in place; this pass does not repaint already accepted controls. The WhatsApp mark must continue to come from the approved CTA partial. For future generic icons, use Lucide rather than drawing another path. For brand marks (Laptopia, WhatsApp, Windows/Microsoft, Google, Waze), use an approved existing or official asset. No generated marks, emoji, Unicode pictograms, CSS imitations, or arbitrary libraries.

No Windows brand icon is introduced here. The existing neutral `software` symbol is a service concept, not represented as the Microsoft logo.
