import Drinks from './components/Drinks.vue';
import AddDrink from './components/AddDrink.vue';
import UpdateDrink from './components/UpdateDrink.vue';
import CalculatorInput from './components/CalculatorInput.vue';
import CalculatorResult from './components/CalculatorResult.vue';

export const routes = [{
        name: 'home',
        path: '/',
        component: Drinks
    },
    {
        name: 'add',
        path: '/add',
        component: AddDrink
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: UpdateDrink
    },
    {
        name: 'calculate',
        path: '/calculate',
        component: CalculatorInput
    },
    {
        name: 'result',
        path: '/result',
        component: CalculatorResult
    }
];
