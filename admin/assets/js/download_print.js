function myPrint(){
    var divContents = document.getElementById("myBillingArea").innerHTML;
    var a = window.open('', '');
    a.document.write('<html><title>Customer Receipt</title>');
    a.document.write('<body style="font-family: fangsong;border:2px solid grey">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
}

window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();

function myPrintPDF(invoiceNo){ 

    var elementHTML = document.querySelector("#myBillingArea");
    docPDF.html(elementHTML, {
        callback: function() {
           docPDF.save(invoiceNo+'.pdf');
        },
        x: 15,
        y: 15,
        width: 170,
        windowWidth: 650
    });
}