<php>
use Ozzie\Vino\Page;

Page::middleware(['guest']);
</php>

<template>
  <div
    class="min-h-screen flex flex-col items-center justify-center bg-zinc-50"
  >
    <slot />
  </div>
</template>
