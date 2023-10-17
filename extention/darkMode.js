function DarkMode()
{
    var toggle = document.getElementById("toggle");
    var html = document.getElementById("toogle-dark");
    if(toggle.checked)
    {
        html.setAttribute("data-bs-theme", "dark");
    }
    else
    {
        html.removeAttribute("data-bs-theme");
    }
}