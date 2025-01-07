<php>
use Ozzie\Vino\Page;

Page::middleware(['auth']);

$logout = function() {
    auth()->logout();

    return redirect()->route('login');
};

$user = auth()->user();
</php>

<script setup lang="ts">
import { CircleUser, Home, Menu, Package2 } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuLabel,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Sheet, SheetContent, SheetTrigger } from '@/components/ui/sheet';
import Toaster from '@/components/ui/toast/Toaster.vue';
import { useComponent, useAction, VinoLink, router } from 'vino-vue';
import { onMounted, onUnmounted, ref } from 'vue';

const component = useComponent();
const logout = useAction(component.value.logout);

const routes = ref([]);
let off = null;

onMounted(() => {
  updateRoutes();
  off = router.onNavigate(updateRoutes);
});

onUnmounted(() => {
  off?.();
});

function updateRoutes() {
  routes.value = [
    {
      href: route('home'),
      label: 'Home',
      active: route().current('home'),
      icon: Home,
    },
  ];
}
</script>

<template>
  <div
    class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]"
  >
    <div class="hidden border-r bg-muted/40 md:block">
      <div class="flex h-full max-h-screen flex-col gap-2">
        <div class="flex h-14 items-center border-b px-4 lg:h-[60px] lg:px-6">
          <a href="/" class="flex items-center gap-2 font-semibold">
            <Package2 class="h-6 w-6" />
            <span class="">Acme Inc</span>
          </a>
        </div>
        <div class="flex-1">
          <nav class="grid items-start px-2 text-sm font-medium lg:px-4">
            <VinoLink
              v-for="route in routes"
              :key="route.href"
              :href="route.href"
              class="flex items-center gap-3 rounded-lg px-3 py-2 text-muted-foreground transition-all hover:text-primary"
              :class="{
                'bg-muted text-foreground': route.active,
                'text-muted-foreground': !route.active,
              }"
            >
              <!--              render route.icon dynamically  -->
              <component :is="route.icon" class="h-4 w-4" />
              {{ route.label }}
            </VinoLink>
          </nav>
        </div>
      </div>
    </div>
    <div class="flex flex-col">
      <header
        class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6"
      >
        <Sheet>
          <SheetTrigger as-child>
            <Button variant="outline" size="icon" class="shrink-0 md:hidden">
              <Menu class="h-5 w-5" />
              <span class="sr-only">Toggle navigation menu</span>
            </Button>
          </SheetTrigger>
          <SheetContent side="left" class="flex flex-col">
            <nav class="grid gap-2 text-lg font-medium">
              <a href="#" class="flex items-center gap-2 text-lg font-semibold">
                <Package2 class="h-6 w-6" />
                <span class="sr-only">Acme Inc</span>
              </a>
              <a
                v-for="route in routes"
                :key="route.href"
                :href="route.href"
                class="mx-[-0.65rem] flex items-center gap-4 rounded-xl px-3 py-2 text-muted-foreground hover:text-foreground"
                :class="{
                  'bg-muted text-foreground': route.active,
                  'text-muted-foreground': !route.active,
                }"
              >
                <component :is="route.icon" class="h-5 w-5" />
                {{ route.label }}
              </a>
            </nav>
          </SheetContent>
        </Sheet>
        <div class="w-full flex-1"></div>
        <DropdownMenu>
          <DropdownMenuTrigger as-child>
            <Button variant="secondary" size="icon" class="rounded-full">
              <CircleUser class="h-5 w-5" />
              <span class="sr-only">Toggle user menu</span>
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuLabel>My Account</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem as-child>
              <VinoLink :href="route('profile')">Settings</VinoLink>
            </DropdownMenuItem>
            <DropdownMenuItem>Support</DropdownMenuItem>
            <DropdownMenuSeparator />
            <DropdownMenuItem @click="logout.run">Logout</DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      </header>
      <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
        <slot />
      </main>
    </div>
  </div>

  <Toaster />
</template>
