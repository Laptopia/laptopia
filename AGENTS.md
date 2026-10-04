# Laptopia — Codex instructions

## Project

Laptopia is a production WordPress website for a laptop repair workshop in Israel.

Production URL: `https://laptopia.co.il/`

Repository: `Laptopia/laptopia`
Primary branch: `main`

The public website is primarily Hebrew and RTL.

## Source of truth

When working on a task, use this priority:

1. Explicit instructions in the current task.
2. Current production behavior when the task depends on runtime state.
3. Current code in `main`.
4. Existing repository conventions.
5. Older assumptions or historical implementation.

Never restore old behavior merely because it exists in history.

## General working rules

This is an existing production website. Make conservative, incremental changes.

Change only what is necessary for the current task.

Do not perform unrelated:

- refactoring;
- redesign;
- cleanup;
- dependency changes;
- SEO changes;
- schema changes;
- redirect changes;
- URL changes;
- architecture changes.

If an unrelated issue is discovered, report it separately instead of fixing it.

Do not modify production, WordPress configuration, external services, GitHub settings, or unrelated repository state unless the current task explicitly requires it.

## Protected/high-risk areas

Do not modify these unless the current task specifically requires it:

- homepage;
- `functions.php`;
- shared `template-parts`;
- Google Reviews integration;
- Trustindex/fallback behavior;
- global SEO/schema logic;
- canonical/robots behavior;
- URL structure.

When modification of a shared/high-risk component is required, keep the change as small as possible and check all affected pages.

## Design and UX

Preserve the existing Laptopia visual language.

Reuse existing:

- typography;
- spacing;
- gradients;
- cards;
- buttons/CTA patterns;
- section widths;
- responsive patterns.

Do not introduce a separate design system for an individual page.

Standard pages may use the existing `.laptopia-standard-page` shell where appropriate.

Desktop and mobile behavior are both part of every UI task.

Check especially:

- responsive layout;
- CTA/button widths;
- cards;
- header/footer;
- fixed/sticky elements;
- long Hebrew text;
- RTL behavior;
- horizontal overflow;
- unexpected scroll movement.

A desktop fix is not complete if mobile is broken.

## Google Reviews

The site uses the official Google Places UI Kit / Maps JavaScript API with real Google rating/review/attribution data.

Trustindex may exist as fallback and must not be removed unless explicitly requested.

Current expected carousel behavior:

- 3 cards on desktop;
- 1 card on mobile;
- side arrows;
- autoplay around 5 seconds;
- infinite loop;
- no Play/Pause control;
- autoplay must not change the page scroll position.

Do not reintroduce the bug where the page automatically scrolls to the reviews section.

## SEO and URLs

Preserve existing URL structure and trailing-slash behavior.

Canonical URLs must remain HTTPS.

Rank Math manages SEO title/meta unless a task explicitly requires otherwise.

Sitemap:

`/sitemap_index.xml`

Legal pages:

- `/privacy-policy/`
- `/terms/`

Their accepted indexing policy is:

`noindex, follow`

Do not change this without an explicit SEO task.

Do not add `hreflang` without a real multilingual site structure.

Do not create fake locations, branches, services, pages, reviews, repair cases, or other content for SEO.

## Structured data

Preserve the current structured-data approach unless the task explicitly concerns schema.

Normal service/legal pages must not accidentally regain inappropriate `Article`, author, or `Person` schema.

`areaServed` must not represent service cities as physical Laptopia branches.

## Content

Public Hebrew must sound natural for Israeli users, not like a literal translation.

Do not invent:

- services;
- prices;
- warranties;
- repair times;
- certifications;
- employees;
- branches;
- legal promises;
- technical facts.

Repair cases must describe real repairs only.

Prices that depend on model, parts, or complexity must not be presented as guaranteed fixed prices. Use the site's established wording such as `החל מ-` when appropriate.

Laptopia currently operates as `עוסק פטור`. Do not add VAT or `+ מע״מ` wording unless the business status is explicitly changed in a future task.

When exact prices or commercial terms matter, verify them against the current approved site/code/task rather than relying on historical assumptions.

## Legal and privacy

Never invent factual claims about:

- cookies;
- retention periods;
- hosting;
- analytics;
- security mechanisms;
- DPO;
- personal-data processing;
- third-party services.

When such facts matter, inspect the actual implementation/runtime or report that verification is required.

## Secrets

Never expose or commit:

- API keys;
- credentials;
- passwords;
- tokens;
- private keys;
- other secrets.

Do not include secret values in reports, commits, TASK output, or diagnostic logs.

## Required checks

Use checks appropriate to the files changed.

For PHP changes, run PHP lint on every changed PHP file.

Before considering a coding task complete, normally check:

- relevant syntax/lint;
- `git diff --check`;
- final diff for accidental changes;
- no secrets added;
- affected desktop behavior;
- affected mobile behavior;
- console errors when browser verification is applicable;
- horizontal overflow when UI is affected;
- links/CTA when affected;
- unexpected scroll jumps when interactive UI is affected.

Do not claim that a check passed if it was not actually run.

If a check cannot be performed, state that explicitly in the final report.

## Production verification

Code completion alone does not prove production success.

For tasks that include deployment, the normal release flow is:

code → checks → push/update `main` → production update → LiteSpeed Cache purge → verify the real production URL.

Do not report production PASS before the actual production site has been checked after cache purge.

If the current task does not authorize deployment, do not deploy. Report production verification as not performed/not applicable rather than pretending it passed.

## Scope discipline

The current task defines the allowed scope.

Do not broaden it without explicit instruction.

If completing the task appears to require an out-of-scope change, stop that part and report the dependency instead of silently expanding scope.

## Final report

At the end of every task, provide a concise structured report containing:

1. What changed.
2. Files changed.
3. Checks actually performed and their results.
4. Commit/SHA if a commit was created.
5. Deployment status.
6. Production verification status.
7. Any unresolved problems or warnings.
8. Final status: `PASS` only if everything required by the task was actually completed and verified; otherwise clearly state what remains.

Do not hide failed checks or unresolved issues.
