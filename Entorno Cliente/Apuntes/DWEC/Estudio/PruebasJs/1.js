let iteraciones = 0;

principal: for (let i = 1; i <= 3; i++) {
for (let j = 1; j <= 3; j++) {
iteraciones++;
if (i === 2 && j === 1) {
break principal;
}
}
}

console.log(iteraciones);