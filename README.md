# Agent

Standalone, dynamic Claude-powered agent. Drop the folder on any PHP host. Embed the widget on any website with two `<script>` tags.

Multi-agent: one install can serve multiple agents (resume, product guide, etc.) — each with its own slug, system prompt, and reference sources. The first agent is pre-seeded for Kristian's resume.

## Files

| File | Purpose |
|---|---|
| `config.php` | The only file you edit. DB creds, API key, admin PIN, public URL. |
| `_lib.php` | Shared helpers (PDO, auth, prompt builder, file extraction). Don't edit. |
| `install.php` | One-time setup: creates tables, seeds the resume agent. **Delete after running.** |
| `admin.php` | Admin UI. PIN-gated. Manage agents and sources. |
| `api.php` | Public chat endpoint the widget POSTs to. |
| `widget.js` | The embeddable JS widget (shadow DOM, no dependencies). |
| `embed-demo.html` | Demo page showing the widget in action. |

## Setup

1. Upload all files to a PHP-enabled host (e.g. `agent.wiredhowse.com/`).
2. Edit `config.php`:
   - DB host / name / user / pass
   - `anthropic_api_key`
   - `admin_pin` (change from `1234`)
   - `public_url` (e.g. `https://agent.wiredhowse.com`)
3. Visit `https://your-host/install.php` in a browser. Sign in with your admin PIN. Tables get created and the resume agent gets seeded with starter content.
4. **Delete `install.php`** from the server.
5. Visit `https://your-host/admin.php`. The resume agent will be there. Click **Sources** → add your full resume by drag-drop or paste. Adjust priorities. Done.
6. Copy the embed snippet from the agent's Sources page and paste it on `kristianoubre.wiredhowse.com` (or anywhere).

## Adding more agents

In admin: **+ New agent**. Set a slug, name, system preamble, optional chips. Add reference sources. Use a different embed snippet on each host.

## How priority works

Each source has a priority 0–100. When the agent answers, sources are concatenated into the system prompt **in descending priority order**. Higher-priority sources appear first, which the LLM treats as more authoritative when sources conflict. Disabled sources are skipped entirely.

## File drop in admin

The "Add a source" form accepts drag-and-drop or click-to-upload for:
- `.txt`, `.md`, `.json`, `.csv` — used as-is
- `.html`, `.htm` — auto-stripped to plain text
- `.pdf` — not supported in v1; convert to text first or paste content directly

## Database tables

- `agent_agents` — one row per agent (slug, name, greeting, chips, preamble, accent, model, enabled)
- `agent_sources` — reference documents linked to an agent (label, content, priority, enabled, notes, file_name)

## Requirements

- PHP 8+ with PDO, cURL, JSON
- MySQL 5.7+ (utf8mb4)
- Sessions enabled (used for admin auth)

## Security notes

- The admin PIN is session-based. Use a strong PIN.
- The API key never leaves the server. Widget calls go through `api.php`.
- CORS is wide-open on `api.php` so the widget works from any embed host. Lock down via `Access-Control-Allow-Origin` if you want a single allowed domain.
- Delete `install.php` after first run.
