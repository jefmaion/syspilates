(function (factory) {
            typeof define === 'function' && define.amd ? define(factory) :
            factory();
        })((function () { 'use strict';

        
        
            const params = new Proxy(new URLSearchParams(window.location.search), {
                get: (searchParams, prop) => searchParams.get(prop)
            });
            for (const key in themeConfig) {
                let selectedValue;
                selectedValue = themeConfig[key];
                if (key === "theme") {
                    // só o "theme" é dinâmico
                    if (!!params.theme) {
                        localStorage.setItem('tabler-theme', params.theme);
                        selectedValue = params.theme;
                    } else {
                        const storedTheme = localStorage.getItem('tabler-theme');
                        selectedValue = storedTheme ? storedTheme : themeConfig.theme;
                    }
                } 
                document.documentElement.setAttribute('data-bs-' + key, selectedValue);
            }
        }));